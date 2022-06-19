<template>
<div>
    <table class="table table-responsive">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Snippet</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="snippet in snippets.data" :key="snippet.id">
      <td>{{snippet.title}}</td>
      <td>{{snippet.snippet}}</td>
      <td>{{snippet.description}}</td>
     
    </tr>
   
   
  </tbody>
</table>
</div>
</template>
<script>
import axios from 'axios'

export default {
    data() {
        return {
            snippets: {}
        }
    },
    methods: {
        getSnippets() {
            axios.get('/api/home/snippets').then(res => {
                this.snippets = res.data;
                console.log(this.snippets);
            }).catch(err => console.log(err));
        }
    },
    mounted() {
        this.getSnippets();
    }
}
</script>