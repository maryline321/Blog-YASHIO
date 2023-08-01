<template>

    <div class="nav">
       
    <div class="button-group">
<button class="button" @click="()=>toggleForm()">Add post</button>
    </div>

    </div>
</template>

<script>
export default {

    props: ["toggleForm"]

}

</script>

<style>

.nav {

    padding: 16px;
    display: flex;
    align-items:center;
    justify-content: space-between;
}

.nav h2{
    color:var(--dark);
    font-size:32px;
    font-weight: 400;

}

</style>