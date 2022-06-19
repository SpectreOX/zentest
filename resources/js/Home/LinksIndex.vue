<template>
<div>
    <table class="table table-responsive">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Link</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="link in links.data" :key="link.id">
      <td>{{link.title}}</td>
      <td><a href="#" @click="clickLink(link.link, link.target)">{{link.link}}</a></td>
       <td>
        <button class="btn btn-light" @click="copyText(link.link)">Copy</button>
      </td>
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
            links: {}
        }
    },
    methods: {
      copyText(link) {
        this.$copyText(link)
        .then(() => {
    console.log("copied!");
  })
  .catch(() => {
    console.log(`can't copy`);
  });
      },
        getLinks() {
            axios.get('/api/home/links').then(res => {
                this.links = res.data;
                console.log(this.links);
            }).catch(err => console.log(err));
        },
    
    clickLink(link,target) {
      
      window.open(link, target == 0 ? '_blank' : '_self');
    }
    },
    mounted() {
      this.getLinks();
    }
}
</script>