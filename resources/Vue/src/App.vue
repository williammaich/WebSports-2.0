<template>
<div :class="{'nav-open': $sidebar.showSidebar}">
  <router-view></router-view>
  <vue-progress-bar style="height: 5px !important"></vue-progress-bar>
  <!--This sidebar appears only for screens smaller than 992px-->
  <side-bar type="navbar" :sidebar-links="$sidebar.sidebarLinks">
    <ul class="nav navbar-nav">
      <li>
        <a>
          <i class="ti-settings"></i>
          <p>Settings</p>
        </a>
      </li>
      <li class="divider"></li>
    </ul>
  </side-bar>
</div>
</template>

<script>
export default {
  created() {
    this.$router.beforeEach((to, from, next) => {
      //  does the page we want to go to have a meta.progress object
      if (to.meta.progress !== undefined) {
        let meta = to.meta.progress
        // parse meta tags
        this.$Progress.parseMeta(meta)
      }
      //  start the progress bar
      this.$Progress.start()
      //  continue to next page
      next()
    })
    //  hook the progress bar to finish after we've finished moving router-view
    this.$router.afterEach((to, from) => { 
      //  finish the progress bar
    })
    this.$http.interceptors.push(function(request, next) {
      let token = localStorage["token"];
      if (!token) {
        token = "{}";
      } else {
        token = JSON.parse(token);
      }
      // modify request
      request.headers.set("Authorization", "Bearer " + token.access_token);
      // console.log(request.headers.get("Authorization"));
      request.headers.set("Accept", "application/vnd.mob.v1+json");
      request.emulateJSON = true;

      // continue to next interceptor
      next(function(response) {
      this.$Progress.finish()

        if (response.status == 500) {
          if (response.data.message == "Token has expired, but is still valid.") {
            console.log("RETRY", response);
          } else {
            console.log("Whoops, an unknown error occured.");
          }
        }
      });
    });
  }
}
</script>

<style lang="scss">
* {
  font-family: "Montserrat";
  font-weight: 400;
}
</style>
