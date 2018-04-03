import Auth from '../store/auth'
Auth.initialize()
export default {
    guest (to, from, next) {
        next(!Auth.check())
    },
    auth (to, from, next) {
        next(Auth.check() ? true : {
            path: '/login',
            query: {
                redirect: to.name
            }
        })
    }
}