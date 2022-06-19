<template>
<div>
    <main>
            <div class="recent-orders">
                <h2>Files</h2>
              <div class="button" @click="showModal = true;">
                <span class="material-icons-sharp">add</span>
               <h3 >Add File</h3>
       
              </div>
              <div class="control-panel">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>File</th>
                            <th></th>
                        </tr>
                    </thead>
                   
  <tbody>
     <tr v-for="file in files.data" :key="file.id">
   
      <td>{{file.title}}</td>
      <td><a @click="onClick(file.file)">{{file.file}}</a></td>

         <td>
        <button style="background: transparent;" type="button" @click="getFile(file.id);showupdateModal = true;"><span style="cursor: pointer;" class="primary material-icons-sharp">edit</span></button>
        <button style="background: transparent;" type="button"  @click="deleteFile(file.id)"><span style="cursor: pointer;" class="danger material-icons-sharp">delete</span></button>
      </td>      
    </tr>
                     
                    </tbody>
                </table>
              </div>
              </div>
              </main>
               <div class="modal-vue">
  
  
  <!-- overlay -->
  <div class="overlay" v-if="showModal" @click="showModal = false"></div>
  
  <!-- modal -->
  <div class="modal" style="width: 70%; top: 140px; left: 120px;" v-if="showModal">
    <button class="close" @click="showModal = false"><span style="cursor: pointer" class="danger material-icons-sharp">clear</span></button>
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Add File</h3>
      </div>
      <div class="modal-body">
      
      <div class="myform">
        <label for="name">Title:</label>
        <div>
        <input type="text" required v-model="file.title"  class="inputform">
        </div>
      </div>
        <div class="myform">
        <label for="name">File:</label>
        <div>
        <input type="file" required @change="handleFile"  class="inputform">
        </div>
      </div>


      
    </div>
    <div class="modal-footer">
                <button type="button" @click="addFile()"  class="btn btn-primary" > <i class="fa-light fa-plus"></i>Add</button>
                <button type="button" @click="showModal = false" class="btn btn-danger" > <i class="fa-solid fa-xmark"></i>Close</button>

           </div>
      </div>
  </div>
  
</div>

 <div class="modal-vue">
  
  
  <!-- overlay -->
  <div class="overlay" v-if="showupdateModal" @click="showupdateModal = false"></div>
  
  <!-- modal -->
  <div class="modal" style="width: 70%; top: 140px; left: 120px;" v-if="showupdateModal">
    <button class="close" @click="showupdateModal = false"><span style="cursor: pointer" class="danger material-icons-sharp">clear</span></button>
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Update File</h3>
      </div>
      <div class="modal-body">
      
      <div class="myform">
        <label for="name">Title:</label>
        <div>
        <input type="text" required v-model="file.title" class="inputform">
        </div>
      </div>
        <div class="myform">
        <label for="name">File:</label>
        <div>
        <input type="file" required @change="handleFile"  class="inputform">
        </div>
      </div>


      
    </div>
    <div class="modal-footer">
                <button type="button" @click="updateFile(file.id)" class="btn btn-primary" > <i class="fa-solid fa-pen-to-square"></i>Update</button>
                          <button type="button" @click="showupdateModal = false" class="btn btn-danger" > <i class="fa-solid fa-xmark"></i>Close</button>

           </div>
      </div>
  </div>
  
</div>
</div>
</template>

<script>
import axios from 'axios'


export default {
    data() {
        return { 
            file: {title: '', file: ''},
            files: {},
            showModal : false,
            showupdateModal: false,
        }
    },
    methods: {
        getFiles() {
            axios.get('/api/files').then(res => {
                this.files = res.data;
                console.log(this.files);
            }).catch(err => console.log(err))
        },
        handleFile(e) {
            this.file.file = e.target.files[0];
        },
        getFile(id)
            {
                 axios.get('/api/files/' + id)
                .then(res => {
                  
                    this.file = res.data.data;
                    console.log(this.File);
                }).catch(error => console.log(error));
            },
        addFile() {
             const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
            let formData = new FormData();
            formData.append('title', this.file.title);
            formData.append('file', this.file.file);
            
                axios.post('/api/files', formData, config).then(res => {
                    if(res.data.status == 201) {
                    this.$swal('Done','File has been successfully added','success')
                    this.getFiles();
                    this.file = {title: '',file: ''};
                    }
                    else {
                        this.$swal({icon: 'error', title: 'Oops...', text: 'Something is wrong here !'});
                    }
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


        updateFile(id) {
          axios.put('/api/files/' + id, this.file).then(res => {
            if(res.data.status == 201) {
                this.$swal('Done', 'file has been Successfully updated', 'success')
                    this.getFiles();
                    this.file = {title: '',file: ''};
                    }
                    else {
                        this.$swal({icon: 'error', title: 'Oops...', text: 'Something is wrong here !'});
                    }
            
          }).catch(err => console.log(err))
        },

        deleteFile(id) {
           
          axios.delete('/api/files/' + id, this.file).then(res => {
           
               if(res.data.status == 201) {
                    this.$swal( 'Done', 'file has been Successfully removed', 'success')
                    this.getFiles();
                    this.file = {title: '',file: ''};
                    }
                    
            
           
          }).catch(err => console.log(err));
           
        }
        
    },
    mounted() {
        this.getFiles();
    }
}
</script>