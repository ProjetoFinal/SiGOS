#!/bin/bash
export PATH=$PATH:/opt/lampp/bin

echo "Informe seu login:"
read LOGIN
TABLE="sigos.usuario"


NEWPASS=`echo -n "51g0512345651g05" | sha1sum | cut -d' ' -f1`
QUERY="UPDATE $TABLE SET senha = '$NEWPASS' WHERE login = '$LOGIN'";

echo "Senha reinicializada com sucesso!"
echo "Entre no sistema utiizando usuário $LOGIN e senha 123456"

mysql -u root << eof
$QUERY
eof
