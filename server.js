import express from 'express'
import dotenv from 'dotenv'
import cors from 'cors'
import path from 'path'
import { fileURLToPath } from 'url'

import contactRoutes from './routes/contact.js'
import authRoutes from './routes/auth.js'
import dashboardRoutes from './routes/dashboard.js'

dotenv.config()
const app = express()
const PORT = process.env.PORT || 3000

const __filename = fileURLToPath(import.meta.url)
const __dirname = path.dirname(__filename)

app.use(cors())
app.use(express.json())
app.use(express.urlencoded({ extended: true }))

// ✅ Servir HTML
app.use(express.static(path.join(__dirname, 'public')))

// APIs
app.use('/contacto', contactRoutes)
app.use('/auth', authRoutes)
app.use('/dashboard', dashboardRoutes)

app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`)
})

