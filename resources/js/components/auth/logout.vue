<script setup>
import AppStorage from '../../helpers/AppStorage'
import {onBeforeMount } from 'vue'
import { useRouter} from 'vue-router'

const router = useRouter()

onBeforeMount(() => {
    AppStorage.clear()
    Toast.fire({
            icon: 'success',
            title: 'Logged out successfully!'
            })
    });

    router.push({name: 'login'})

</script>
