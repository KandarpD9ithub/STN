import Vue from 'vue';
import Router from 'vue-router';
import Example from './components/ExampleComponent.vue';
import Login from './components/users/loginComponent.vue';
import home from './components/home/homeComponent.vue';
import cover1 from './components/coverpage1/indexComponent.vue';
import cover2 from './components/coverpage2/indexComponent.vue';
import cover3 from './components/coverpage3/indexComponent.vue';
import frontCoverComponent from './components/coverpage1/frontCoverComponent.vue';
import insideFrontCoverComponent from './components/coverpage1/insideFrontCoverComponent.vue';
import insideBackCoverComponent from './components/coverpage1/insideBackCoverComponent.vue';
import backCoverComponent from './components/coverpage1/backCoverComponent.vue';
// Cover 2
import c2insideFrontCoverComponent from './components/coverpage2/insideFrontCoverComponent.vue';
import c2frontCoverComponent from './components/coverpage2/frontCoverComponent.vue';
import c2insideBackCoverComponent from './components/coverpage2/insideBackCoverComponent.vue';
import c2backCoverComponent from './components/coverpage2/backCoverComponent.vue';
// Cover 3
import c3insideFrontCoverComponent from './components/coverpage3/insideFrontCoverComponent.vue';
import c3frontCoverComponent from './components/coverpage3/frontCoverComponent.vue';
import c3insideBackCoverComponent from './components/coverpage3/insideBackCoverComponent.vue';
import c3backCoverComponent from './components/coverpage3/backCoverComponent.vue';

// Cover 4
import c4insideFrontCoverComponent from './components/coverpage4/insideFrontCoverComponent.vue';
import c4frontCoverComponent from './components/coverpage4/frontCoverComponent.vue';
import c4insideBackCoverComponent from './components/coverpage4/insideBackCoverComponent.vue';
import c4backCoverComponent from './components/coverpage4/backCoverComponent.vue';

// Cover 5
import c5insideFrontCoverComponent from './components/coverpage5/insideFrontCoverComponent.vue';
import c5frontCoverComponent from './components/coverpage5/frontCoverComponent.vue';
import c5insideBackCoverComponent from './components/coverpage5/insideBackCoverComponent.vue';
import c5backCoverComponent from './components/coverpage5/backCoverComponent.vue';

import myComponent from './components/myCustomize/masterComponent.vue';
import myLibraryComponent from './components/myCustomize/myLibraryComponent.vue';
import magazineProfileComponent from './components/myCustomize/magazineProfileComponent.vue';

import logoutComponent from './components/users/logoutComponent.vue';
import HomeMasterComponent from './components/home/masterComponent.vue';

import profile from './components/Profile.vue';

Vue.use(Router)

export default new Router({
    routes: [
      {
        path: '/',
        name: 'login',
        component: Login
      },
      {
        path: '/profile',
        name: 'profile',
        component: profile
      },
      {
        path: '/logout',
        name: 'logout',
        component: logoutComponent
      },
      {
        path: '/example',
        name: 'Example',
        component: Example
      },
      {
        path: '/home',
        name: 'home',
        component: home
      },
      {
        // route for my Librery
        path: '/my',
        name: 'my',
        component: myComponent,
        children: [
          {
            path: 'myLibrary',
            name: 'myLibrary',
            component: myLibraryComponent
          },
          {
            path: 'magazineProfile',
            name: 'magazineProfile',
            component: magazineProfileComponent
          },
        ]
      },
      {
        path: '/cover1',
        name: 'cover1',
        component: HomeMasterComponent,
        children: [
          {
            path: 'frontCover',
            name: 'frontCover',
            component: frontCoverComponent
          },
          {
            path: 'insideFrontCover',
            name: 'insideFrontCover',
            component: insideFrontCoverComponent
          },
          {
            path: 'insideBackCover',
            name: 'insideBackCover',
            component: insideBackCoverComponent
          },
          {
            path: 'backCover',
            name: 'backCover',
            component: backCoverComponent
          }
        ]
      },
      {
        path: '/cover2',
        name: 'cover2',
        component: HomeMasterComponent,
        children: [
          {
            path: 'frontCover',
            name: 'c2FrontCover',
            component: c2frontCoverComponent,
          },
          {
            path: 'insideFrontCover',
            name: 'c2insideFrontCover',
            component: c2insideFrontCoverComponent,
          },
          {
            path: 'insideBackCover',
            name: 'c2insideBackCover',
            component: c2insideBackCoverComponent,
          },
          {
            path: 'backCover',
            name: 'c2backCover',
            component: c2backCoverComponent,
          }
        ]
      },
      {
        path: '/cover3',
        name: 'cover3',
        component: HomeMasterComponent,
        children: [
          {
            path: 'frontCover',
            name: 'c3FrontCover',
            component: c3frontCoverComponent,
          },
          {
            path: 'insideFrontCover',
            name: 'c3insideFrontCover',
            component: c3insideFrontCoverComponent,
          },
          {
            path: 'insideBackCover',
            name: 'c3insideBackCover',
            component: c3insideBackCoverComponent,
          },
          {
            path: 'backCover',
            name: 'c3backCover',
            component: c3backCoverComponent,
          }
        ]
      },
      // book cover 4
      {
        path: '/cover4',
        name: 'cover4',
        component: HomeMasterComponent,
        children: [
          {
            path: 'frontCover',
            name: 'c4FrontCover',
            component: c4frontCoverComponent,
          },
          {
            path: 'insideFrontCover',
            name: 'c4insideFrontCover',
            component: c4insideFrontCoverComponent,
          },
          {
            path: 'insideBackCover',
            name: 'c4insideBackCover',
            component: c4insideBackCoverComponent,
          },
          {
            path: 'backCover',
            name: 'c4backCover',
            component: c4backCoverComponent,
          }
        ]
      },

      // book cover 5
      {
        path: '/cover5',
        name: 'cover5',
        component: HomeMasterComponent,
        children: [
          {
            path: 'frontCover',
            name: 'c5FrontCover',
            component: c5frontCoverComponent,
          },
          {
            path: 'insideFrontCover',
            name: 'c5insideFrontCover',
            component: c5insideFrontCoverComponent,
          },
          {
            path: 'insideBackCover',
            name: 'c5insideBackCover',
            component: c5insideBackCoverComponent,
          },
          {
            path: 'backCover',
            name: 'c5backCover',
            component: c5backCoverComponent,
          }
        ]
      },
    ]
})
