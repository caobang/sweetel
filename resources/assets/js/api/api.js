import axios from 'axios'

let base = '/api/v1'


export const getUserInfo = () => { return axios.get(`${base}/userinfo`).then(res => res.data) }

export const getUserMenus = () => { return axios.get(`${base}/usermenus`).then(res => res.data) }

export const updateUserStatus = params => { return axios.patch(`${base}/userstatus`,params).then(res => res.data) }


export const getUserGroups = () => { return axios.get(`${base}/usergroups`).then(res => res.data) }

export const addUserGroup = params => { return axios.post(`${base}/usergroups`,params).then(res => res.data) }

export const editUserGroup = params => { return axios.put(`${base}/usergroups/${params.id}`,params).then(res => res.data) }

export const delUserGroup = id => { return axios.delete(`${base}/usergroups/${id}`).then(res => res.data) }


export const getRoles = () => { return axios.get(`${base}/roles`).then(res => res.data) }

export const addRole = params => { return axios.post(`${base}/roles`,params).then(res => res.data) }

export const editRole = params => { return axios.put(`${base}/roles/${params.id}`,params).then(res => res.data) }

export const delRole = id => { return axios.delete(`${base}/roles/${id}`).then(res => res.data) }


export const getPagingUsers = params => { return axios.get(`${base}/users`,{params:params}).then(res => res.data) }

export const addUser = params => { return axios.post(`${base}/users`,params).then(res => res.data) }

export const editUser = params => { return axios.put(`${base}/users/${params.id}`,params).then(res => res.data) }

export const delUser = id => { return axios.delete(`${base}/users/${id}`).then(res => res.data) }
