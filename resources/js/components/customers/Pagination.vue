<style lang="scss">
.pagination {
    justify-content: flex-end !important;
    .page-stats {
        align-items: center;
        margin-right: 5px;
    }
    i {
        color: #3273dc !important;
    }
}
</style>

<template>
    <nav class="pagination" v-if="!client">
        <a v-if="pagination.prevPageUrl" @click="$emit('prev');">
            <i class="fas fa-chevron-circle-left"></i>
        </a>
        <a v-else :disabled="true">
          <i class="fas fa-chevron-circle-left"></i>
        </a>
        <span class="page-stats">{{pagination.from}} - {{pagination.to}} of {{pagination.total}}</span>

        <a v-if="pagination.nextPageUrl" class="button is-small pagination-next" @click="$emit('next');">
            <i class="fas fa-chevron-circle-right"></i>
        </a>
        <a class="button is-small pagination-next" v-else :disabled="true">
           <i class="fas fa-chevron-circle-right"></i>
        </a>
    </nav>

    <nav class="pagination" v-else>
        <span class="page-stats">
            {{pagination.from}} - {{pagination.to}} of {{filtered.length}}
            <span v-if="filtered.length <= pagination.total ">(filtered from {{pagination.total}} total entries)</span>
        </span>
        <a v-if="pagination.prevPage" @click="$emit('prev');">
           <i class="fas fa-chevron-circle-right"></i>
        </a>
        
        <a v-else :disabled="true">
         <i class="fas fa-chevron-circle-left"></i>
        </a>
        
        <span class="page-stats">{{ pagination.from }} - {{pagination.to}} of {{pagination.total}}</span>

        <a v-if="pagination.nextPage" class="button is-small pagination-next" @click="$emit('next');">
            <i class="fas fa-chevron-circle-right"></i>
        </a>
        <a class="button is-small pagination-next" v-else :disabled="true">
          <i class="fas fa-chevron-circle-right"></i>
        </a>
    </nav>
</template>

<script>
    export default {
        props: ['pagination', 'client', 'filtered']
    }
</script>