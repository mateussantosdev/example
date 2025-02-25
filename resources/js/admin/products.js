import { baseApiUrl } from './../config';
import { toast } from './../toast';

document.addEventListener('DOMContentLoaded', function () {
    const createProductForm = document.getElementById('create-product-form');
    const addCategoryBtn = document.getElementById('addCategoryBtn');
    const categoryModal = document.getElementById('categoryModal');
    const categoryModalTitle = document.getElementById('categoryModalTitle');
    const cancelCategoryBtn = document.getElementById('cancelCategoryBtn');
    const saveCategoryBtn = document.getElementById('saveCategoryBtn');
    const CategoryName = document.getElementById('CategoryName');
    const checkBoxes = document.getElementById('checkBoxes');
    const selectBox = document.querySelector('.selectBox');
    const searchCategoryInput = document.getElementById('searchCategory');
    let editingCategory = null;

    function showCheckboxes() {
        checkBoxes.classList.toggle('hidden');
        updateCategoryOrder();
    }

    function updateCategoryOrder() {
        const searchQuery = searchCategoryInput.value.toLowerCase();
        const categories = Array.from(checkBoxes.children);
        categories.sort((a, b) => {
            const categoryNameA = a.querySelector('span').textContent.toLowerCase();
            const categoryNameB = b.querySelector('span').textContent.toLowerCase();
            if (categoryNameA.includes(searchQuery)) return -1;
            if (categoryNameB.includes(searchQuery)) return 1;
            return 0;
        });
        checkBoxes.innerHTML = '';
        categories.forEach(category => {
            checkBoxes.appendChild(category);
        });
    }

    selectBox.addEventListener('click', function (event) {
        event.stopPropagation();
        showCheckboxes();
    });

    document.addEventListener('click', function (event) {
        if (!selectBox.contains(event.target) && !checkBoxes.contains(event.target) && !categoryModal.contains(event.target) && !addCategoryBtn.contains(event.target) && !searchCategoryInput.contains(event.target)) {
            checkBoxes.classList.add('hidden');
        }
    });

    addCategoryBtn.addEventListener('click', function () {
        categoryModalTitle.innerHTML = 'Adicionar Nova Categoria';
        CategoryName.value = '';
        editingCategory = null;
        categoryModal.classList.remove('hidden');
    });

    cancelCategoryBtn.addEventListener('click', function () {
        categoryModal.classList.add('hidden');
    });

    saveCategoryBtn.addEventListener('click', function () {
        const categoryName = CategoryName.value.trim();
        if (categoryName) {
            if (editingCategory) {
                const categoryId = editingCategory.querySelector('input[type="checkbox"]').value;
                axios.put(`${baseApiUrl}/categories/${categoryId}`, {
                    name: categoryName
                })
                    .then(response => {
                        toast(response.data.message);
                        editingCategory.querySelector('span').textContent = categoryName;
                        editingCategory = null;
                    })
                    .catch(error => {
                        toast(error.response.data.errors[Object.keys(error.response.data.errors)[0]][0], error.response.data.status);
                    });

            } else {
                axios.post(`${baseApiUrl}/categories`, { name: categoryName })
                    .then(response => {

                        toast(response.data.message);

                        const newLabel = document.createElement('label');
                        newLabel.classList.add('flex', 'items-center', 'p-2');
                        newLabel.innerHTML = `
                            <input type="checkbox" name="categories[]" value="${response.data.id}" class="mr-2">
                            <span>${categoryName}</span>
                            <button type="button" class="ml-auto text-blue-600 hover:text-blue-800 edit-category">Editar</button>
                            <button type="button" class="ml-2 text-red-600 hover:text-red-800 delete-category">Deletar</button>
                        `;
                        checkBoxes.appendChild(newLabel);

                        newLabel.querySelector('.edit-category').addEventListener('click', function (event) {
                            event.stopPropagation();
                            const categoryName = newLabel.querySelector('span').textContent;
                            categoryModalTitle.innerHTML = 'Alterar Categoria';
                            CategoryName.value = categoryName;
                            editingCategory = newLabel;
                            categoryModal.classList.remove('hidden');
                        });

                        newLabel.querySelector('.delete-category').addEventListener('click', function (event) {
                            event.stopPropagation();
                            newLabel.remove();
                        });
                    })
                    .catch(error => {
                        toast(error.response.data.errors[Object.keys(error.response.data.errors)[0]][0], error.response.data.status);
                    });
            }

            categoryModal.classList.add('hidden');
            CategoryName.value = '';
        } else {
            toast('O nome da categoria é obrigatório', 'error')
        }
    });

    searchCategoryInput.addEventListener('input', function () {
        updateCategoryOrder();
    });

    document.querySelectorAll('.edit-category').forEach(button => {
        button.addEventListener('click', function (event) {
            event.stopPropagation();
            const categoryLabel = this.closest('label');
            const categoryName = categoryLabel.querySelector('span').textContent;
            categoryModalTitle.innerHTML = 'Alterar Categoria';
            CategoryName.value = categoryName;
            editingCategory = categoryLabel;
            categoryModal.classList.remove('hidden');
        });
    });

    document.querySelectorAll('.delete-category').forEach(button => {
        button.addEventListener('click', function (event) {
            event.stopPropagation();
            const categoryLabel = this.closest('label');
            const categoryId = categoryLabel.querySelector('input[type="checkbox"]').value;

            axios.delete(`${baseApiUrl}/categories/${categoryId}`)
                .then(response => {
                    toast(response.data.message);
                    categoryLabel.remove();
                })
                .catch(error => {
                    toast(error.response.data.errors[Object.keys(error.response.data.errors)[0]][0], error.response.data.status);
                });
        });
    });

    const productWithVariationCheckbox = document.getElementById('productWithVariation');
    const addVariationBtn = document.getElementById('addVariationBtn');
    const additionalVariations = document.getElementById('additional-variations');
    let variationCount = 1;

    // Evento para checkbox
    productWithVariationCheckbox.addEventListener('change', function () {
        if (this.checked) {
            addVariationBtn.classList.remove('hidden');
            addVariationBtn.addEventListener('click', addVariation);
        } else {
            addVariationBtn.classList.add('hidden');
            additionalVariations.innerHTML = '';
            variationCount = 1;
        }
    });

    // Função para adicionar variação
    function addVariation() {
        variationCount++;
        const variationHTML = `
            <div class="mb-4 product-items flex space-x-2 items-center justify-center variation" id="variation_${variationCount}">
                <div class="flex-1">
                    <label for="prices[]" class="block text-gray-700 text-sm font-medium price-label">Preço Variação ${variationCount}</label>
                    <input type="number" step="any" name="prices[]" placeholder="Preço Variação ${variationCount}"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex-1">
                    <label for="stocks[]" class="block text-gray-700 text-sm font-medium stock-label">Estoque Variação ${variationCount}</label>
                    <input type="number" name="stocks[]" placeholder="Quantidade em estoque Variação ${variationCount}"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="button" class="px-4 py-2 mt-5 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 remove-variation-btn" data-variation-id="${variationCount}">&minus;</button>
            </div>
        `;
        additionalVariations.insertAdjacentHTML('beforeend', variationHTML);

        const removeBtn = document.querySelector(`#variation_${variationCount} .remove-variation-btn`);
        removeBtn.addEventListener('click', function () {
            const variation = this.closest('.variation');
            variation.remove();
            renumberVariations();
        });
    }

    // Função para renumerar as variações
    function renumberVariations() {
        const variations = additionalVariations.querySelectorAll('.variation');
        variations.forEach((variation, index) => {
            const newCount = index + 2;
            variation.id = `variation_${newCount}`;

            const priceLabel = variation.querySelector('.price-label');
            const priceInput = priceLabel.nextElementSibling;

            if (priceLabel && priceInput) {
                priceLabel.innerText = `Preço Variação ${newCount}`;
                priceInput.placeholder = `Preço Variação ${newCount}`;
            }

            const stockLabel = variation.querySelector('.stock-label');
            const stockInput = stockLabel.nextElementSibling;

            if (stockLabel && stockInput) {
                stockLabel.innerText = `Estoque Variação ${newCount}`;
                stockInput.placeholder = `Quantidade em estoque Variação ${newCount}`;
            }

            variation.querySelector('.remove-variation-btn').dataset.variationId = newCount;
        });
        variationCount = variations.length + 1;
    }

    createProductForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const selectedCategories = Array.from(document.querySelectorAll('input[name="categories[]"]:checked')).map(checkbox => parseInt(checkbox.value));
        console.log('Categorias selecionadas:', selectedCategories);
    });
});
