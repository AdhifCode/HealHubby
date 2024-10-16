export default function ({ store, redirect, $cookies }) {
  store.dispatch('users/setcookie')
  const cekadmin = $cookies.get('loginCookie')
  if (store.state.users.authenticated && cekadmin.data.data.role_id !== 1) {
    console.log('Nda Lolos middleware login')
    return redirect('/')
  } else {
    console.log('Lolos middleware login')
  }
}
