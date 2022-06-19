<template>
<div>
    <div>
     <div class="container">
            <aside :class="seen == true ? 'seen' : 'unseen'" > 
                <div class="top">
                    <div class="logo">
                        <h2>ZEN<span class="danger">TEST </span></h2>
                    </div>
                    <div id="close-btn" @click="seen = false" class="close">
                        <span class="material-icons-sharp">close</span>
                    </div>
                </div>
                <div class="sidebar">
                    <!--
                    <router-link  :class="this.$route.name == 'dashbord' ? 'active': ''" :to="{ name: 'dashbord' }">
                        <span class="material-icons-sharp">grid_view</span>
                        <h3>Dashbord</h3>
                    </router-link>
                    -->
                    <router-link :class="this.$route.name == 'files' ? 'active': ''" :to="{ name: 'files' }">

                        <span class="material-icons-sharp">file_copy</span>
                        <h3>Files</h3>
                   </router-link>
                     <router-link :class="this.$route.name == 'links' ? 'active': ''" :to="{ name: 'links' }">
                        <span class="material-icons-sharp">link</span>
                        <h3>Links</h3>
                    </router-link>
                <router-link :class="this.$route.name == 'snippets' ? 'active': ''" :to="{ name: 'snippets' }">

                        <span class="material-icons-sharp">text_snippet</span>
                        <h3>Snippets</h3>
                   </router-link>
                    <a href="/">

                        <span class="material-icons-sharp">home</span>
                        <h3>Home</h3>
                   </a>
                   
                </div>
            </aside>
        
        <!-- end of sidebar-->
<router-view></router-view>  

</div>
</div>
</div>
</template>
<script>
export default {
  name: 'admin',
  
 data() {
   return {
     
     seen: true,
   };
   
 },
   mounted() {
         document.documentElement.className = 'dark';

   }
}
</script>
<style scoped>
@import "../../css/admin.css";
.seen {
  display: block;
}
.unseen {
  display: none;
}
</style>