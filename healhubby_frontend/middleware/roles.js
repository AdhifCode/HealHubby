export default function ({ store, redirect }) {
  if (store.state.auth.user && store.state.auth.user.role !== 'admin') {
    return redirect('/unauthorized')
  }
}
