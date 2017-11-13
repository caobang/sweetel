import axios from 'axios'

let base = '/api/v1'


export const getUserInfo = () => { return axios.get(`${base}/userinfo`).then(res => res.data) }

export const getUserMenus = () => { return axios.get(`${base}/usermenus`).then(res => res.data) }
