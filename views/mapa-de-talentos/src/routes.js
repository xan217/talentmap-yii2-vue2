import Home    from '@/pages/home/Home'
import Values    from '@/pages/values/Values'
import Users    from '@/pages/chart/Users'
import Graph    from '@/pages/graph/Graph'
import Charts    from '@/pages/chart/Chart'

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
];

export default routes;