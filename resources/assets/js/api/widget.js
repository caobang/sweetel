import axios from 'axios'

let base = '/wapi'


export const getConfig = params => { return axios.get(`${base}/config`, params).then(res => res.data) }


