import express from 'express'
import { createClient } from '@supabase/supabase-js'

const router = express.Router()

const supabase = createClient(
  process.env.SUPABASE_URL,
  process.env.SUPABASE_ANON_KEY
)

router.post('/login', async (req, res) => {
  const { email, password } = req.body

  if (!email || !password) {
    return res.status(400).json({ error: 'Datos incompletos' })
  }

  const { data, error } = await supabase.auth.signInWithPassword({
    email,
    password
  })

  if (error) {
    return res.status(401).json({ error: 'Credenciales incorrectas' })
  }

  const user = data.user

  res.json({
    status: 'OK',
    token: data.session.access_token,
    user: {
      id: user.id,
      email: user.email,
      nombre: user.user_metadata?.nombre || user.email
    }
  })
})

export default router