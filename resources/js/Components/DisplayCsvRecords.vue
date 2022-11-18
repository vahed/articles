<script setup>
import { ref, reactive, computed } from 'vue'

defineProps({
    articles: Object
});

const columns = reactive(['Title', 'Section Name', 'Created']);


</script>
<template>
    <div>
        <table style="overflow-x:auto;" v-if="articles">
            <thead>
                <tr>
                    <th v-for="(column, index) in columns" :key="index"> {{column}}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="article in articles" :key="article.id">
                    <td>{{ article.title }}</td>
                    <td>{{ article.section.section_name }}</td>
                    <td>{{ article.created }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>