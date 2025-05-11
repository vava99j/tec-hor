import mysql from 'mysql2/promise';

export default async function handler(req, res) {
  if (req.method !== 'POST') {
    return res.status(405).send('Método não permitido');
  }

  try {
    const { name, email, phone, textarea } = req.body;

    const conn = await mysql.createConnection({
      host: 'caboose.proxy.rlwy.net',
      user: 'root',
      password: 'cmycwbxOMFMpcibfJvVWEuGkLfZMvtbQ',
      database: 'railway',
      port: 13240,
    });

    await conn.execute(
      'INSERT INTO DBMensagem (nome, email, telefone, mensagem) VALUES (?, ?, ?, ?)',
      [name, email, phone, textarea]
    );

    await conn.end();
    res.status(200).send('sucesso');
  } catch (error) {
    console.error(error);
    res.status(500).send('erro no servidor');
  }
}
