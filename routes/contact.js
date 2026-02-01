import express from 'express'
import sql from '../db.js'
import nodemailer from 'nodemailer'

const router = express.Router()

// Ruta POST para recibir contacto
router.post('/', async (req, res) => {
    const { nombre, apaterno, correo, telefono, asunto, mensaje } = req.body

    // Validación
    if (!nombre || !apaterno || !correo || !telefono || !asunto || !mensaje) {
        return res.status(400).json({ error: 'Todos los campos son obligatorios' })
    }

    try {
        const insertResult = await sql`
            INSERT INTO tb_usuarios (nombre_usuario, apaterno_usuario, correo_usuario, telefono_usuario, asunto_usuario, mensaje)
            VALUES (${nombre}, ${apaterno}, ${correo}, ${telefono}, ${asunto}, ${mensaje})`

        // Configuración de nodemailer
        const transporter = nodemailer.createTransport({
            service: 'gmail',
            auth: {
                user: process.env.EMAIL_USER,
                pass: process.env.EMAIL_PASS
            }
        })

        // Correo al admin
        await transporter.sendMail({
            from: '"SysConsult" <sysconsut78@gmail.com>',
            to: 'sysconsut78@gmail.com',
            subject: `Nuevo mensaje de contacto: ${asunto}`,
            text: `
                    Nombre: ${nombre} ${apaterno}
                    Correo: ${correo}
                    Telefono: ${telefono}

                    Mensaje:
                    ${mensaje}`
        })

        // Correo de respuesta al usuario
        await transporter.sendMail({
            from: '"SysConsult" <no.reply@sysconsult.com>',
            to: correo,
            subject: 'Hemos recibido tu mensaje - SysConsult',
            text: `
            Hola ${nombre},

            Gracias por contactarnos.

            Hemos recibido tu mensaje con el asunto:
            "${asunto}"

            Nos pondremos en contacto contigo a la brevedad a través de correo o teléfono.

            Saludos cordiales.
            Equipo SysConsult`
        })

        res.json({ status: 'OK' })
    } catch (err) {
        console.error(err)
        res.status(500).json({ error: 'Error al guardar o enviar correo' })
    }
})

export default router
