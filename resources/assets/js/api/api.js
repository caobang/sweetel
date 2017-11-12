import axios from 'axios'
//axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
//axios.defaults.headers.common['X-CSRF-TOKEN'] = 'eDQjeyvHenmOFuNWcsm3PERKzAZpFfUzMsDXsDNu';

let base = '/api/v1'


export const getUserInfo = params => { return axios.get(`${base}/userinfo`, params).then(res => res.data) }

export const getMenus = params => { return axios.get(`${base}/menus`, params).then(res => res.data) }

