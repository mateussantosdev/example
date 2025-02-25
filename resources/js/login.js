import { baseApiUrl, baseWebUrl } from './config';

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('login-form').addEventListener('submit', function (event) {
        event.preventDefault();

        let formData = new FormData(this);

        axios.post(`${baseApiUrl}/login`, {
            email: formData.get('email'),
            password: formData.get('password')
        })
            .then(response => {

                const token = response.data.token;

                document.cookie = `token=${token}; path=/; secure; samesite=strict`;

                axios.get(`${baseApiUrl}/permissions`, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                })
                    .then(response => {

                        const permissions = response.data.permissions

                        if (permissions.includes('view_dashboard')) {
                            window.location.href = `${baseWebUrl}/dashboard`;
                            return;
                        }

                        window.location.href = `${baseWebUrl}`;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            })
            .catch(error => {
                console.error(error);
            });
    });
});
