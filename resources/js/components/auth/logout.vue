<script setup>

import {onBeforeMount } from 'vue'
import { useRouter} from 'vue-router'

const router = useRouter()

onBeforeMount(() => {
    localStorage.removeItem('token')
    localStorage.removeItem('user')
    Toast.fire({
            icon: 'success',
            title: 'Logged out successfully!'
            })
    });

    router.push({name: 'login'})

</script>
