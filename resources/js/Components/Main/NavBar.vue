<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <Link class="navbar-brand" :href="route('dashboard')">Navbar</Link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <Link class="nav-link active" aria-current="page" :href="route('student')">Add Student</Link>
                </li>
            </ul>

            <span>
                <Link :href="route('login')">Login</Link>
            </span> || <span>
                <Link :href="route('register')">Register</Link>
            </span>


        </div>
    </div>
</nav>
</template>

<script>
import{ Link } from "@inertiajs/vue3"
export default {
    components: {
        Link
    }
}

</script>

<style lang="scss" scoped>

</style>
