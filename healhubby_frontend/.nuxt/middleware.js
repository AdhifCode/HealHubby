const middleware = {}

middleware['admin'] = require('..\\middleware\\admin.js')
middleware['admin'] = middleware['admin'].default || middleware['admin']

middleware['authenticated'] = require('..\\middleware\\authenticated.js')
middleware['authenticated'] = middleware['authenticated'].default || middleware['authenticated']

middleware['guest'] = require('..\\middleware\\guest.js')
middleware['guest'] = middleware['guest'].default || middleware['guest']

middleware['permission'] = require('..\\middleware\\permission.js')
middleware['permission'] = middleware['permission'].default || middleware['permission']

middleware['roles'] = require('..\\middleware\\roles.js')
middleware['roles'] = middleware['roles'].default || middleware['roles']

export default middleware
