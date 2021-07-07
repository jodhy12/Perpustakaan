var contoh1 = new Vue({
    el: '#contoh-1',
    data: {
        counter: 0
    }
})

//   Contoh 2
var contoh2 = new Vue({
    el: '#contoh-2',
    data: {
        name: 'Vue.js'
    },
    // mendefinisikan metode dibawah `methods` object
    methods: {
        greet: function (event) {
            // `this` di dalam metode merujuk ke Vue instance
            alert('Hello ' + this.name + '!')
            // `event` adalah bawaan DOM event
            if (event) {
                alert(event.target.tagName)
            }
        }
    }
})

// // Anda juga dapat memanggil metode dalam JavaScript
// contoh2.greet() // => 'Hello Vue.js!'

//   Contoh 3
new Vue({
    el: '#contoh-3',
    methods: {
        say: function (message) {
            alert(message)
        }
    },

})

// Contoh 4
new Vue({
    el: '#contoh-4',
    methods: {
        warn: function (message, event) {
            // sekarang kita memiliki akses ke event bawaan
            if (event) event.preventDefault()
            alert(message)
        }
    }
})

