import './bootstrap'
import { createApp } from 'vue'
import vSelect from 'vue-select'

// Components ---------------------------------------------------
import TheProductList from './components/Products/TheProductList.vue'
import ProductDetail from './components/Products/ProductDetail.vue'
import TheCategoryList from './components/Category/TheCategoryList.vue'
import CartView from './components/Carts/CartView.vue'
import BackendError from './components/Components/BackendError.vue'

const app = createApp({
	components: {
		TheProductList,
		TheCategoryList,
		ProductDetail,
		CartView,
	}
})

app.component('v-select', vSelect)
app.component('backend-error', BackendError)
app.mount('#app')

