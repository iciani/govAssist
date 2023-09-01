describe('GovAssist Url Test', () => {
	const urlTest = 'http://localhost:3000'

	beforeEach(() => {
		cy.visit(urlTest)
	})

	it('Should get into Url List, and retrieve the data.', () => {
		cy.viewport(1800, 1080)
		cy.Login()
		cy.getByDataCy('urlBtn').should('be.visible').click()
		cy.wait('@UrlList').its('response.statusCode').should('eq', 200)
		cy.log('End of Tests Case')
	})

	it('Should get into Url List, retrieve the data, select the first element, and Show it.', () => {
		cy.viewport(1800, 1080)
		cy.Login()
		cy.getByDataCy('urlBtn').should('be.visible').click()
		cy.wait('@UrlList').its('response.statusCode').should('eq', 200)
		cy.getByDataCy('show_action_1').click({ force: true })
		cy.log('End of Tests Case')
	})

	it('Should get into Url List, select line 2, and delete it.', () => {
		cy.viewport(1800, 1080)
		cy.Login()
		cy.getByDataCy('urlBtn').should('be.visible').click()
		cy.getByDataCy('delete_action_2').click({ force: true })
		cy.get('form').submit()
		cy.wait('@urlDelete').its('response.statusCode').should('eq', 200)
		cy.wait('@UrlList').its('response.statusCode').should('eq', 200)
		cy.log('End of Tests Case')
	})
})
