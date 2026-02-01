import express from 'express'
import sql from '../db.js'
import { createClient } from '@supabase/supabase-js'

const router = express.Router()

const supabase = createClient(
  process.env.SUPABASE_URL,
  process.env.SUPABASE_ANON_KEY
)

router.get('/', async (req, res) => {
  try {
    const token = req.headers.authorization?.split(' ')[1]

    if (!token) {
      return res.status(401).json({ error: 'Error al cargar dashboard' })
    }

    const { data, error } = await supabase.auth.getUser(token)

    if (error) {
      return res.status(401).json({ error: 'Token inválido' })
    }

    res.json({
      status: 'OK',
      message: 'Dashboard cargado correctamente',
      user: data.user
    })

  } catch (err) {
    console.error(err)
    res.status(500).json({ error: 'Error interno del servidor' })
  }
})

router.get('/stats', async (req, res) => {
  try {
    const result = await sql`
      SELECT COUNT(*) AS total
      FROM tb_usuarios
    `
    res.json({
      totalCorreos: Number(result[0].total)
    })

  } catch (err) {
    console.error(err)
    res.status(500).json({ error: 'Error al obtener estadísticas' })
  }
})

export default router
