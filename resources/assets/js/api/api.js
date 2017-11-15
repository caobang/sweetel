import axios from 'axios'

let base = '/api/v1'


export const getUserInfo = () => { return axios.get(`${base}/userinfo`).then(res => res.data) }

export const getUserMenus = () => { return axios.get(`${base}/usermenus`).then(res => res.data) }

export const updateUserStatus = params => { return axios.patch(`${base}/userstatus`,params).then(res => res.data) }

export const getUserGroups = () => { return axios.get(`${base}/usergroups`).then(res => res.data) }

export const addUserGroup = params => { return axios.post(`${base}/usergroups`,params).then(res => res.data) }

export const editUserGroup = params => { return axios.patch(`${base}/usergroups/${params.id}`,params).then(res => res.data) }

export const delUserGroup = id => { return axios.delete(`${base}/usergroups/${id}`).then(res => res.data) }
