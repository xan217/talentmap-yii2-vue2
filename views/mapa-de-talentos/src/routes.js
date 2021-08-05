import Home    from '@/pages/home/home'
import Values    from '@/pages/values/values'
import Users    from '@/pages/users/users'
import Graph    from '@/pages/graph/graph'
import Charts    from '@/pages/chart/chart'
import Config    from '@/pages/config/config'

const routes = [
   { 
      path: '/', 
      name: 'home',
      component: Home 
   },
   { 
      path: '/values', 
      name: 'values',
      component: Values 
   },
   { 
      path: '/users', 
      name: 'users',
      component: Users 
   },
   { 
      path: '/graph', 
      name: 'graph',
      component: Graph 
   },
   { 
      path: '/charts', 
      name: 'charts',
      component: Charts 
   },
   { 
      path: '/config', 
      name: 'config',
      component: Config 
   },
];

export default routes;