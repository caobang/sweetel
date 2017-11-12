import axios from 'axios'

let base = '/api/widget'


export const getConfig = tid => { return axios.get(`${base}/configs/${tid}`).then(res => res.data) }


