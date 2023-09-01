<template>
	<v-card class="mt-10" variant="tonal">
		<v-data-table
			:headers="headers"
			:items="urls"
			:total-items="urls.length"
			rows-per-page-items="10"
			:loading="loading"
			item-key="id">
			<template v-slot:top>
				<v-toolbar flat>
					<v-toolbar-title>My Urls List</v-toolbar-title>
					<v-spacer></v-spacer>
				</v-toolbar>
			</template>

			<!-- link on shortdest { item }-->
			<template v-slot:[`item.shortdest`]="{ item }">
				<a :href="item.raw.shortdest" target="_blank" @click="addViewItem(item.raw)">
					{{ item.raw.shortdest }}
				</a>
			</template>

			<!-- chip on views { item }-->
			<template v-slot:[`item.views`]="{ item }">
				<v-chip
					:color="item.raw.views > 0 ? 'primary' : 'gray'"
					prepend-icon="mdi-web"
					variant="outlined">
					{{ item.raw.views }}
				</v-chip>
			</template>

			<!-- chip on state { item }-->
			<template v-slot:[`item.state`]="{ item }">
				<v-switch
					:loading="stateLoading"
					:color="item.raw.state === globals.INITIAL_STATE ? 'success' : 'grey'"
					:model-value="item.raw.state === globals.INITIAL_STATE ? true : false"
					@click="changeStateItem(item.raw)">
				</v-switch>
			</template>
			<template v-slot:[`item.actions`]="{ item }">
				<v-icon
					:data-cy="'show_action_' + item.raw.id"
					size="small"
					class="me-2"
					@click="showItem(item.raw)">
					mdi-eye
				</v-icon>
				<v-icon
					:data-cy="'delete_action_' + item.raw.id"
					size="small"
					class="me-2"
					@click="deleteItem(item.raw)">
					mdi-delete
				</v-icon>
			</template>
		</v-data-table>

		<v-card-actions>
			<div class="ml-0">
				<v-btn
					color="primary"
					min-width="120"
					variant="outlined"
					@click.stop="addItem()">
					<v-icon class="mr-1"> mdi-plus-circle-outline </v-icon>
					Add Url
				</v-btn>
			</div>
		</v-card-actions>
	</v-card>
	<v-dialog
		:key="componentKey + 1"
		:CloseOnEscape="false"
		persistent
		v-model="showDialog"
		:width="display.smAndDown ? '100%' : '60%'"
		:fullscreen="display.smAndDown">
		<UrlForm
			:key="componentKey"
			:p-active-row="activeRow"
			:p-operator="operator"
			@onSave="SaveData"
			@closeComponent="showDialog = false" />
	</v-dialog>
</template>

<script setup>
import { ref, onMounted, nextTick, inject } from 'vue'
import { useDisplay } from 'vuetify'
import { VDataTable } from 'vuetify/labs/VDataTable'
import UrlForm from './UrlForm.vue'
import urlApi from '@/api/urlApi'
const axios = inject('axios')
const globals = inject('globals')

//We import an API file per Entity with its related endpoints.
const urlEndpoints = urlApi(axios)

//Data
const display = ref(useDisplay())
const urls = ref([])
const loading = ref(true)
const showDialog = ref(false)
const activeRow = ref([])
const operator = ref('')
const componentKey = ref(0)
const stateLoading = ref(false)

const headers = [
	{ title: 'Id', align: 'end', key: 'id', type: 'int' },
	{
		title: 'Original Dest.',
		align: 'end',
		sortable: false,
		key: 'destination',
		width: '30%',
	},
	{ title: 'State', align: 'end', sortable: false, key: 'state' },
	{ title: 'Short Dest.', align: 'end', sortable: false, key: 'shortdest' },
	{ title: 'Views', align: 'end', sortable: false, key: 'views', type: 'int' },
	{
		title: 'Created At',
		align: 'end',
		sortable: false,
		key: 'created_at',
		type: 'date',
		width: '10%',
	},
	{
		title: 'Updated At',
		align: 'end',
		sortable: false,
		key: 'updated_at',
		type: 'date',
		width: '10%',
	},
	{
		title: 'Actions',
		key: 'actions',
		align: 'center',
		width: '150',
		sortable: false,
	},
]

//Events
onMounted(() => {
	getListData()
})

//Functions
const forceRerender = async () => {
	componentKey.value += 1
	showDialog.value = false
	await nextTick()
	showDialog.value = true
}

const getListData = async () => {
	try {
		loading.value = true
		const response = await urlEndpoints.List()
		urls.value = response.data
	} catch (error) {
		loading.value = false
		return []
	} finally {
		loading.value = false
	}
}

const changeState = async () => {
	try {
		stateLoading.value = true

		//Inverting the State
		switch (activeRow.value.state) {
			case globals.INACTIVE_STATE:
				activeRow.value.state = globals.INITIAL_STATE
				break
			case globals.INITIAL_STATE:
				activeRow.value.state = globals.INACTIVE_STATE
				break
			default:
				break
		}

		await urlEndpoints
			.ChangeState({ id: activeRow.value.id, state: activeRow.value.state })
			.then(() => {
				stateLoading.value = false
			})
	} catch (error) {
		stateLoading.value = false
	}
}

//ADD ITEM
const addItem = () => {
	operator.value = 'Add'
	showDialog.value = true
	forceRerender()
}

//SHOW ITEM
const showItem = data => {
	forceRerender()
	operator.value = globals.SHOW
	showDialog.value = true
	activeRow.value = data
}

//DELETE ITEM
const deleteItem = data => {
	forceRerender()
	operator.value = globals.DELETE
	showDialog.value = true
	activeRow.value = data
}

//CHANGE STATE OF ITEM
const changeStateItem = data => {
	activeRow.value = data
	changeState()
}

//ADD VIEW COUNT + 1 IN SELECTED ROW
const addViewItem = data => {
	activeRow.value = data
	activeRow.value.views++
}

const SaveData = () => {
	showDialog.value = false
	getListData()
}
</script>

<style>
.state-chip {
	/* width: 170px !important; */
	white-space: normal;
}
</style>
