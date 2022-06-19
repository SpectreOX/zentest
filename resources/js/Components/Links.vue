<template>
<div>
  <main>
            <div class="recent-orders">
                <h2>Links</h2>
              <div class="button" @click="showModal = true;">
                <span class="material-icons-sharp">add</span>
               <h3 >Add Link</h3>
       
              </div>
              <div v-for="(v, k) in errors" :key="k" >
              <div class="alert" v-for="error in v" :key="error">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{error}}
                </div>
                </div>
              <div class="control-panel">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Target</th>
                            <th></th>
                        </tr>
                    </thead>
                   
  <tbody>
     <tr v-for="link in links.data" :key="link.id">
   
      <td>{{link.title}}</td>
      <td>{{link.link}}</td>
      <td>{{link.target }}</td>

         <td>
        <button style="background: transparent;" type="button" @click="getLink(link.id);showupdateModal = true;"><span style="cursor: pointer;" class="primary material-icons-sharp">edit</span></button>
        <button style="background: transparent;" type="button"  @click="deleteLink(link.id)"><span style="cursor: pointer;" class="danger material-icons-sharp">delete</span></button>
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
        <h3 class="modal-title">Add link</h3>
      </div>
      <div class="modal-body">
      
      <div class="myform">
        <label for="name">Title:</label>
        <div>
        <input type="text" required v-model="link.title"  class="inputform">
        </div>
      </div>
        <div class="myform">
        <label for="name">Link:</label>
        <div>
        <input type="text" required v-model="link.link"  class="inputform">
        </div>
      </div>
       <div class="myform">
        <label for="target">Target:</label>
        <div>
        <select required  v-model="link.target" class="inputform">
      <option :value="0" >open in a new tabe</option>
      <option :value="1" >same page</option>

    </select>
        </div>
      </div>

      
    </div>
    <div class="modal-footer">
                <button type="button" @click="addLink()"  class="btn btn-primary" > <i class="fa-light fa-plus"></i>Add</button>
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
        <h3 class="modal-title">Update Link</h3>
      </div>
      <div class="modal-body">
      
      <div class="myform">
        <label for="name">Title:</label>
        <div>
        <input type="text" required v-model="link.title" class="inputform">
        </div>
      </div>
        <div class="myform">
          <label for="name">Link:</label>
          <div>
            <input type="text" required v-model="link.link" placeholder="https://www.site.com/" class="inputform">
          </div>
        </div>
       <div class="myform">
        <label for="target">Target:</label>
        <div>
        <select required  v-model="link.target" class="inputform">
        <option :value="0" >open in a new tabe</option>
        <option :value="1" >same page</option>
        </select>
        </div>
      </div>

             

      
    </div>
    <div class="modal-footer">
                <button type="button" @click="updateLink(link.id)" class="btn btn-primary" > <i class="fa-solid fa-pen-to-square"></i>Update</button>
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
            link: {title: '', link: '', target: ''},
            links: {},
            showModal : false,
            showupdateModal: false,
            errors: '',
        }
    },
    methods: {
        getLinks() {
            axios.get('/api/links').then(res => {
                this.links = res.data;
                console.log(this.links);
            }).catch(err => {
              	this.errors = err.response.data.errors;
                console.log(this.errors);
            });
        },
        getLink(id)
            {
                 axios.get('/api/links/' + id)
                .then(res => {
                  
                    this.link = res.data.data;
                    console.log(this.link);
                }).catch(err => {
              	this.errors = err.response.data.errors;
            });
            },
        addLink() {
            
                axios.post('/api/links', this.link).then(res => {
                    if(res.data.status == 201) {
                    this.$swal('Done','link has been Successfully added','success')
                    this.getLinks();
                    this.link = {title: '',link: '', target: ''};
                    }
                    else {
                        this.$swal({icon: 'error', title: 'Oops...', text: 'Something is wrong here !'});
                    }
                }).catch(error => {
              	this.errors = error.response.data.errors;
                console.log(this.errors);
            });
           
        },


        updateLink(id) {
          axios.put('/api/links/' + id, this.link).then(res => {
            if(res.data.status == 201) {
                this.$swal('Done', 'link has been Successfully updated', 'success')
                    this.getLinks();
                    this.link = {title: '',link: '', target: ''};
                    }
                    else {
                        this.$swal({icon: 'error', title: 'Oops...', text: 'Something is wrong here !'});
                    }
            
          }).catch(error => {
              	this.errors = error.response.data.errors;
            });
        },

        deleteLink(id) {
           
          axios.delete('/api/links/' + id, this.link).then(res => {
           
               if(res.data.status == 201) {
                    this.$swal( 'Done', 'link has been Successfully removed', 'success')
                    this.getLinks();
                    this.link = {title: '',link: '', target: ''};
                    }
                    
            
           
          }).catch(err => {
              	this.errors = err.response.data.errors;
            });
           
        }
        
    },
    mounted() {
        this.getLinks();
    }
}
</script>