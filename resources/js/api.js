// resources/js/api.js

import axios from 'axios';

const API_BASE = 'https://panel-web.unw.ac.id/api';

export const getPrograms = async () => {
    const response = await axios.get(`${API_BASE}/unw-program-studi`);
    return response.data;
};