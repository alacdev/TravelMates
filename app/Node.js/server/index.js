import express from 'express'
import logger from 'morgan'

import { Server } from 'socket.io'
import { createServer } from 'node:http'

const port = process.env.PORT ?? 3000

const app = express()
const server = createServer(app)
const io = new Server(server, {
    connectionStateRecovery: {} //no se si está funcionando
})

io.on('connection', (socket) => {
    console.log('un usuario se ha conectado!')
    socket.on ('chat message', (msg) =>  {
        io.emit('chat message', msg)
    })
})

app.use(logger('dev'))

app.get('/', (req, res) => {
    res.sendFile(process.cwd() + '/client/chat.view.html')
})

server.listen(port, () => {
    console.log('Server running on port ${port}')
})