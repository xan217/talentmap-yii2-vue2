const Request = {
    install (Vue) {
        Vue.api_route = "http://localhost/socialgrafo_v2/web/index.php?r=api/";
        //Vue.api_route = "https://newstetic.vcb.com.co/mapa-de-talentos/web/index.php?r=api/";
        //Vue.api_route = "https://www.experiencianewstetic.com/mapa-de-talentos/web/index.php?r=api/";
        Vue.fetchData = async function(method, endpoint = '', data = {}) {
            // Opciones por defecto estan marcadas con un *
            let options = {
                method: method, // *GET, POST, PUT, DELETE, etc.
                mode: 'cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                credentials: 'same-origin', // include, *same-origin, omit
                headers: {
                'Content-Type': 'application/json'
                // 'Content-Type': 'application/x-www-form-urlencoded',
                },
                redirect: 'follow', // manual, *follow, error
                referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            }
            if(method != 'GET' && method != 'HEAD'){
                options.body = JSON.stringify(data)
            }

            const response = await fetch(Vue.api_route + endpoint, options);

            return response.json(); // parses JSON response into native JavaScript objects
        }
      }
};

export default Request;