<template>
  <div class="menu-header">
    <div class="menu-title">
      <h1>{{ title }}</h1>
    </div>
    <div class="menu-setting">
      <div class="setting"> 
        <div class="image-container image-format-hd">
          <div class="frame">
            <div style="max-width: 50px; max-height: 50px;" class="usr">
              <!-- <img onclick="profile()" src="@if(Auth::user()->avatar){{ asset('storage/'.Auth::user()->avatar) }}@else{{ asset('images/avatars/default.png') }}@endif" style="border-radius: 50%; cursor: pointer;"> -->
            </div>
          </div>
        </div>
        <!-- <div class="split-button">
          <ul class="split-content d-menu" data-role="dropdown">
            <li><a href="#">Reply</a></li>
            <li><a href="#">Reply All</a></li>
            <li><a href="#">Forward</a></li>
          </ul>
        </div> -->
        <!-- <span class="p-2 badge badge-danger">{{ $store.getters.activeUser.username }}</span>
        <button class="cycle-button bg-steel fg-white no-border" @click="aboutApp">
          <span data-role="hint" data-hint-background="bg-steel" data-hint-color="fg-white" data-hint-mode="2" data-hint="About App" data-hint-position="bottom" class="mif-info"></span>
        </button>
        <button class="cycle-button bg-steel fg-white no-border" @click.prevent="whatsNew">
          <span data-role="hint" data-hint-background="bg-steel" data-hint-color="fg-white" data-hint-mode="2" data-hint="What's New?" data-hint-position="bottom" class="mif-history"></span>
        </button>
        <button class="cycle-button bg-steel fg-white no-border" @click.prevent="showSkin">
          <span data-role="hint" data-hint-background="bg-steel" data-hint-color="fg-white" data-hint-mode="2" data-hint="Skins" data-hint-position="bottom" class="mif-palette"></span>
        </button> -->
        <!-- <button class="cycle-button bg-steel fg-white no-border" onclick="announcement()">
          <span data-role="hint" data-hint-background="bg-steel" data-hint-color="fg-white" data-hint-mode="2" data-hint="Announcement" data-hint-position="bottom" class="mif-bell"></span>
        </button> -->
        <!-- <button class="cycle-button bg-steel fg-white no-border" @click.prevent="logout">
          <i data-role="hint" data-hint-background="bg-steel" data-hint-color="fg-white" data-hint-mode="2" data-hint="Sign Out" data-hint-position="bottom" class="fa fa-sign-out"></i>
        </button> -->
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data()
  {
    return {
      title : 'HRIS',
    }
  },
  methods : {
    logout() {
      let con = confirm('are you sure to logout from hris?')
      if(!con)
        return
      axios.post(base_domain('/logout')).then(res=>{
        window.location = base_domain('/home')
      }).catch(err=>{
        handleError(err)
      })
    },
    whatsNew(){
      $('#whatsNewModal').modal()
    },
    showSkin(){
      showCharms('#charmSkins')
    },
    aboutApp(){
      showCharms('#charmAboutApp')
    }
  },
  created()
  {
    axios(base_domain('/api/marketing-idea-name')).then(res=>{
      this.title = res.data
      this.$store.commit('SET_APP_TITLE', this.title)
    })
  }
}
</script>