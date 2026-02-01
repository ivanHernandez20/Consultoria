import postgres from 'postgres'
import dotenv from 'dotenv'

dotenv.config()

const sql = postgres(process.env.DATABASE_URL, {
  ssl: {
    rejectUnauthorized: false
  }
  /* ssl: 'require' */
})

export default sql