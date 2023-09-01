<template>
	<v-card class="mt-10">
		<v-sheet class="pa-2 ma-2">
			<v-row justify="center" align="center" no-gutters>
				<v-col cols="12" sm="6" md="6" lg="6" class="pb-10">
					<v-img
						max-width="500px"
						src="https://govassist.com/wp-content/uploads/2022/03/govassist_logo.svg"></v-img>
				</v-col>
			</v-row>
			<h1>The Tech Challenge</h1>
			<h5>Laravel Assessment Task</h5>
			<p class="text-justify">
				The web application that needs to be developed will be a basic URL-shortening
				service. It will have a basic form that consists of 1 text input field and 1
				submit button. The text input field will be used for “destination URL” which
				will basically be the long URL that will be shortened. Below the input field,
				there should be a simple table showing the latest created URLs on the system.
				The form should be only accessible by logged-in users, meaning the
				application would need to have some sort of basic authentication for login
				and registration (there’s no need to do this from scratch).</p
			>
			<br />
			<h5>Requirements of Model</h5>
			<p>Create a Url model with the following properties:</p>
			<div class="mt-5 ml-7">
				<ul>
					<li> Id destination (string): it will contain the long URL. </li>
					<li> slug (string): it will contain the slug of the shortened URL. </li>
					<li> views: it will contain the times the link has been opened. </li>
					<li> Timestamps (created at, updated at). </li>
				</ul>
			</div>
			<br />

			<h5>Description of Challenge</h5>
			<p class="text-justify">Create a migration for the model above.</p>
			<p class="text-justify">
				Implement an auth system for login and registration.
			</p>
			<p>
				Create a form that will only be accessible to registered and logged-in users.
			</p>
			<p>
				Create an input text field for the “destination” or long-URL and a submit
				button.
			</p>
			<p class="text-justify">
				Add validations to the form so it will not allow the text field to be “empty”
				and only allow valid URLs. The form once is valid and submitted, it should
				store the destination URL in the DB using the Url model. It is also required
				to generate a 5- character long random string that will be used as the “slug”
				property.
			</p>
			<p class="text-justify">
				Create the routes needed and make use of model binding for them when
				applicable (for the Url model). Make sure that the route that will redirect
				the shortened URL to the actual long-URL is created and that the view count
				for that URL is increased by one each time it’s visited.
			</p>
			<p> The use of Laravel helpers/facades is encouraged. </p>

			<p> Add feature/unit tests as you see fit. </p>
			<p>
				Create a scheduled task that deletes links that were not visited for the past
				30 days.
			</p>
			<p>
				Create a README.md file documenting your application (the more detailed the
				better)
			</p>
			<p>
				Create a simple POST REST API endpoint that takes “destination” as a required
				property of the request body. If no “destination” is provided then it should
				return a validation error. The same is applied when a non-valid URL is
				provided.
			</p>
			<br />
			<p>Sample of valid payload for the endpoint:</p>
			<pre>
				{ 
					"destination": "https://google.com"
				}
			</pre
			>
			<br />
			<p>Expected JSON response on success:</p>
			<pre>
				{ 
					"destination": "https://google.com",
					"slug": "k9GZw",
					"updated_at": "2021-09-10T23:52:11.000000Z",
					"created_at": "2021-09-10T23:52:11.000000Z",
					"id": 18,
					"shortened_url": "http://url-shortener.test/k9GZw" 
				} </pre
			>
			<br />
			<h5>Important to consider</h5>
			<p>
				Make sure to use a git repository (either bitbucket or GitHub) to store the
				code of your application. Then share the URL of the repository with us. Make
				sure the repository is public.
			</p>
			<p>
				Feel free to add any additional “feature” that you may think it’s worth
				adding (feel free to show off here; extra points for creativity)
			</p>
			<p>
				Please follow the best coding practices/principles, standard naming
				conventions, etc.
			</p>
			<p>
				Add code comments where possible so we can understand your thinking behind
				the code logic Completion.
			</p>
			<br />
			<h5>Deliver</h5>
			<p> Time This task should take 2-4 days to complete. </p>
		</v-sheet>
	</v-card>
</template>
