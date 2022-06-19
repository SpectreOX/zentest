<template>
<div>
  <main>
            <!-- end of insights-->
            <div class="recent-orders">
                <h2>Snippets</h2>
              <div class="button" @click="showModal = true;">
                <span class="material-icons-sharp">add</span>
               <h3 >Add Snippet</h3>

               
              </div>
              <div class="control-panel">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Snippet</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                   
  <tbody>
     <tr v-for="snippet in snippets.data" :key="snippet.id">
   
      <td>{{snippet.title}}</td>
      <td>{{snippet.snippet}}</td>
      <td>{{snippet.description.substring(0,55)+".." }}</td>

         <td>
        <button style="background: transparent;" type="button" @click="getSnippet(snippet.id);showupdateModal = true;"><span style="cursor: pointer;" class="primary material-icons-sharp">edit</span></button>
        <button style="background: transparent;" type="button"  @click="deleteSnippet(snippet.id)"><span style="cursor: pointer;" class="danger material-icons-sharp">delete</span></button>
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
        <h3 class="modal-title">Add Snippet</h3>
      </div>
      <div class="modal-body">
      
      <div class="myform">
        <label for="name">Title:</label>
        <div>
        <input type="text" required v-model="snippet.title"  class="inputform">
        </div>
      </div>
        <div class="myform">
        <label for="name">Snippet:</label>
        <div>
        <input type="text" required v-model="snippet.snippet"  class="inputform">
        </div>
      </div>
       <div class="myform">
        <label for="description">Description:</label>
        <div>
    <textarea class="inputform" v-model="snippet.description" required name="description" cols="20"></textarea>

        </div>
      </div>

      
    </div>
    <div class="modal-footer">
                <button type="button" @click="addSnippet()"  class="btn btn-primary" > <i class="fa-light fa-plus"></i>Add</button>
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
        <h3 class="modal-title">Update Snippet</h3>
      </div>
      <div class="modal-body">
      
      <div class="myform">
        <label for="name">Title:</label>
        <div>
        <input type="text" required v-model="snippet.title" class="inputform">
        </div>
      </div>
        <div class="myform">
        <label for="name">Snippet:</label>
        <div>
        <input type="text" required v-model="snippet.snippet"  class="inputform">
        </div>
      </div>
       <div class="myform">
        <label for="description">Description:</label>
        <div>
    <textarea class="inputform" v-model="snippet.description" required name="description" cols="20"></textarea>

        </div>
      </div>

      
    </div>
    <div class="modal-footer">
                <button type="button" @click="updateSnippet(snippet.id)" class="btn btn-primary" > <i class="fa-solid fa-pen-to-square"></i>Update</button>
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
            snippet: {title: '', snippet: '', description: ''},
            snippets: {},
            showModal : false,
            showupdateModal: false,
        }
    },
    methods: {
        getSnippets() {
            axios.get('/api/snippets').then(res => {
                this.snippets = res.data;
                console.log(this.snippets);
            }).catch(err => console.log(err))
        },
        getSnippet(id)
            {
                 axios.get('/api/snippets/' + id)
                .then(res => {
                  
                    this.snippet = res.data.data;
                    console.log(this.snippet);
                }).catch(error => console.log(error));
            },
        addSnippet() {
            
                axios.post('/api/snippets', this.snippet).then(res => {
                    if(res.data.status == 201) {
                    this.$swal('Done','snippet has been Successfully added','success')
                    this.getSnippets();
                    this.snippet = {title: '',snippet: '', description: ''};
                    }
                    else {
                        this.$swal({icon: 'error', title: 'Oops...', text: 'Something is wrong here !'});
                    }
                }).catch(err => console.log(err));
           
        },


        updateSnippet(id) {
          axios.put('/api/snippets/' + id, this.snippet).then(res => {
            if(res.data.status == 201) {
                this.$swal('Done', 'snippet has been Successfully updated', 'success')
                    this.getSnippets();
                    this.snippet = {title: '',snippet: '', description: ''};
                    }
                    else {
                        this.$swal({icon: 'error', title: 'Oops...', text: 'Something is wrong here !'});
                    }
            
          }).catch(err => console.log(err))
        },

        deleteSnippet(id) {
           
          axios.delete('/api/snippets/' + id, this.snippet).then(res => {
           
               if(res.data.status == 201) {
                    this.$swal( 'Done', 'snippet has been Successfully removed', 'success')
                    this.getSnippets();
                    this.snippet = {title: '',snippet: '', description: ''};
                    }
                    
            
           
          }).catch(err => console.log(err));
           
        }
        
    },
    mounted() {
        this.getSnippets();
    }
}
</script>