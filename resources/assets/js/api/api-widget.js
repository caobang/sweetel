import axios from 'axios'

let base = '/api/widget'


export const getConfig = tid => { return axios.get(`${base}/configs/${tid}`).then(res => res.data) }

export const connection = params => { return axios.post(`${base}/connection`,params).then(res => res.data) }

export const sendMessage = params => { return axios.post(`${base}/messages`,params).then(res => res.data) }


