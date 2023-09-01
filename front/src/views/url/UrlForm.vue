<template>
	<v-form
		ref="form"
		v-model="isFormValid"
		@submit.prevent="saveData"
		data-cy="urlForm"
		lazy-validation>
		<v-card class="rounded-lg">
			<v-toolbar dark="" color="primary">
				<v-toolbar-title class="text-h6 grey--text font-weight-ligh">
					Url {{ pOperator }}
				</v-toolbar-title>
				<v-spacer />
				<v-btn :disabled="onSave" icon="" @click.stop="close">
					<v-icon>mdi-close</v-icon>
				</v-btn>
			</v-toolbar>
			<v-divider />

			<v-container fluid class="pa-2">
				<div class="pa-2 mt-0">
					<v-row dense>
						<v-col cols="12" lg="12" md="12" sm="12" class="pa-3 mt-n3">
							<v-row class="pa-2">
								<v-col cols="12" sm="12" class="ma-0 pa-0 mb-2">
									<v-list-subheader class="pb-0 pa-0 ma-0">
										<span class="text-subtitle-1 font-weight-bold primary--text">
											DEFINITION
										</span>
									</v-list-subheader>
									<v-divider class="pa-0 pb-2 mt-n2" />
								</v-col>
								<!-- FIELDS -->
								<v-col
									cols="12"
									lg="12"
									md="12"
									sm="12"
									class="ma-0 pa-0 pl-1 pr-lg-2">
									<v-text-field
										ref="destination"
										v-model="activeRow.destination"
										label="Destination"
										type="text"
										data-cy="destination"
										:rules="[required, url]"
										:disabled="disabled"></v-text-field>
								</v-col>
								<v-col
									cols="12"
									sm="12"
									md="12"
									lg="12"
									class="ma-0 pa-0 pl-1 pr-lg-2">
									<v-textarea
										ref="description"
										v-model="activeRow.description"
										label="Description"
										:disabled="disabled">
									</v-textarea>
								</v-col>
								<v-row />
							</v-row>
						</v-col>
					</v-row>
				</div>
				<v-divider />
				<v-card-actions>
					<v-btn
						type="submit"
						v-if="pOperator != globals.SHOW"
						:disabled="onSave"
						color="primaryBtn"
						variant="outlined"
						min-width="120"
						:class="saveButtonText">
						{{ saveButtonText }}
					</v-btn>
					<v-progress-circular v-if="onSave" indeterminate="" color="secondary" />
					<v-spacer />
					<v-btn
						:disabled="onSave"
						color="primaryBtn"
						variant="outlined"
						min-width="120"
						class="text-capitalize text-subtitle-2 font-weight-medium rounded-l"
						@click.stop="close">
						CANCEL
					</v-btn>
				</v-card-actions>
			</v-container>
		</v-card>
	</v-form>
</template>

<script setup>
import { ref, onMounted, nextTick, inject, computed } from 'vue'
import urlApi from '@/api/urlApi'
import { useNotify } from '@/composables/useNotify'

const { successNotify, errorNotify } = useNotify()
const globals = inject('globals')
const axios = inject('axios')

//We import an API file per Entity with its related endpoints.
const urlEndpoints = urlApi(axios)

//DATA
const onSave = ref(false)
const isFormValid = ref(false)
const emit = defineEmits(['closeComponent', 'onSave'])
const activeRow = ref({
	destination: '',
	description: '',
})
const state = ref('')
const priority = ref('')

//PROPS
const props = defineProps({
	pActiveRow: Object,
	pOperator: String,
})

//EVENTS
onMounted(() => {
	if (props.pOperator != globals.ADD) {
		activeRow.value = Object.assign({}, props.pActiveRow)
	}
	state.value = activeRow.value.state
	priority.value = activeRow.value.priority
})

//Computed
const disabled = computed(() => {
	return props.pOperator === globals.SHOW || props.pOperator === globals.DELETE
		? true
		: false
})

const saveButtonText = computed(() => {
	return props.pOperator === globals.ADD || props.pOperator === globals.EDIT
		? 'SAVE'
		: 'DELETE'
})

//Form Validations (url, required)
const required = value => (value ? true : 'Required Field.')
const url = value =>
	/^(http|https):\/\/[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,}(\/[^/]*)*$/.test(value)
		? true
		: 'Invalid Url.'

//FUNCTIONS (logics)
const close = () => {
	emit('closeComponent')
}

const saveData = async () => {
	if (isFormValid.value && props.pOperator != globals.SHOW) {
		nextTick(() => {
			onSave.value = true
		})
		Save(activeRow.value, props.pOperator)
	}
}

const Save = (data, operator) => {
	const params = {
		id: data.id,
		destination: data.destination,
		description: data.description,
	}

	let pSave
	switch (operator) {
		case globals.ADD:
			pSave = urlEndpoints.Add(params)
			break
		case globals.EDIT:
			pSave = urlEndpoints.Change(params)
			break
		case globals.DELETE:
			pSave = urlEndpoints.Delete(params)
			break
		default:
			return 0
	}

	pSave
		.then(() => {
			emit('onSave')
			successNotify()
			onSave.value = false
		})
		.catch(error => {
			errorNotify(error)
			onSave.value = false
		})
	return 0
}
</script>

<style>
.DELETE {
	color: red !important;
}
</style>
