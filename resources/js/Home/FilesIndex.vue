<template>
<div>

    <table class="table table-responsive">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">File</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="file in files.data" :key="file.id">
      <td>{{file.title}}</td>
      <td>
       <a href="#" @click="onClick(file.file)">{{file.file}}</a>
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
            files: {}
        }
    },
    methods: {
     
        getFiles() {
            axios.get('/api/home/files').then(res => {
                this.files = res.data;
                console.log(this.files);
            }).catch(err => console.log(err));
        },
        onClick(filename) {
            axios({
                  url: 'api/download/' + filename,
                  method: 'GET',
                  responseType: 'arraybuffer',
              }).then((response) => {
                   let blob = new Blob([response.data], {
                            type: 'application/pdf'
                        })
                        let link = document.createElement('a')
                        link.href = window.URL.createObjectURL(blob)
                        link.download = filename
                        link.click()
              });
          },
    },
    mounted() {
      this.getFiles();
    }
}
</script>