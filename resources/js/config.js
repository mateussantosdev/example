export const baseApiUrl = import.meta.env.VITE_API_URL;

export const baseWebUrl = baseApiUrl.replace(/\/api$/, '');
