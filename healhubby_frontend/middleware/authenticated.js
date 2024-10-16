export default async function ({ store, redirect }) {
  console.log('Middleware: authenticated')

  await store.dispatch('users/setcookie')

  const isAuthenticated = store.state.users.authenticated

  console.log('Authenticated state:', isAuthenticated)

  if (!isAuthenticated) {
    console.log('Berhasil')
    return redirect('/')
  }
}
