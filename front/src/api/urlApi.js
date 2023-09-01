export default axios => ({
	List: async () => {
		const response = await axios.get('/urls?per_page=1000&order=id')
		return response.data
	},
	Add: async params => {
		const response = await axios.post('/urls', params)
		return response.data
	},
	ChangeState: async params => {
		const response = await axios.post(`/urls/state`, params)
		return response.data
	},
	Delete: async params => {
		const response = await axios.delete(`/urls/${params.id}`)
		return response.data
	},
})
