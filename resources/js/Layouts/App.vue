<template>
<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Zentest</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link class="nav-link" :to="{name: 'snippets'}">Snippets</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" :to="{name: 'files'}">Files</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" :to="{name: 'links'}">Links</router-link>
        </li>
        
      
      </ul>
      <div class="d-flex">
        <div>
          <a style="text-decoration: none" href="/admin">Admin</a>
        </div>
      </div>
    </div>
  </div>
</nav>
<router-view></router-view>
</div>
</template>