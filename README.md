# tia-pushwebservice
Servidor de Push do MackNotas

# Descrição
Tia-Pushwebservice é uma versão simplificada do `tia-webservice` onde recebe um `JSON` contendo um array com TIA e Senha dos alunos cujas notas devem ser obtidas e devolvidas no mesmo formato gerado pelo `tia-webservice`.

De modo simples, sua única função é obter notas. Devido a limitações do [Heroku](https://heroku.com), preferimos criar um segundo servidor para lidar exclusivamente com requisições da crontab de push, chamada pelo Parse. Poderiamos ter usado apenas o tia-webservice com parametros exclusivos pelo push.

Por conta da diferença, o `tia-pushwebservice` acabou ficando um pouco defasado em relação ao seu pai `tia-webservice`.

Esse é um bom exemplo de como NÃO programar em PHP.

# Exemplo

Eis um exemplo de como é uma requisição `POST`:

```bash
curl -X POST \
      -H "Contenttype: application/json" \
      -H "Cache-Control: no-cache" \
      -H "Content-Type: application/x-www-form-urlencoded" \
      -d 'userTia=["31338526"%2C"31348408"]&userPass=["senha"%2C"senha"]&userUnidade=["001"%2C"001"]' \
      "https://tia-pushwebservice.herokuapp.com/tiaPushJob.php"
```


<details>
<summary>Exemplo de como é a resposta:</summary>

```JSON
[
  [
    {
      "nome": "AUDITORIA SISTEM DE INFORMACAO",
      "notas": [
        "6.9",
        "",
        "",
        "",
        "",
        "8.8",
        "",
        "",
        "",
        "",
        "",
        "",
        "7.8",
        "",
        "7.8"
      ],
      "formulas": [
        "NI1  = (A*5)/5    NI2  = (F*5)/5    MI = (NI1*5 + NI2*5) / 10 + PARTICMF = (MI + PF) / 2"
      ],
      "tia": "31338526"
    },
    {
      "nome": "ESTAGIO SUPERVISIONADO",
      "notas": [
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "Aprovado"
      ],
      "formulas": [
        "PF"
      ],
      "tia": "31338526"
    },
    {
      "nome": "GOVERNANCA DE TI",
      "notas": [
        "9.0",
        "",
        "",
        "",
        "",
        "8.0",
        "",
        "",
        "",
        "",
        "",
        "",
        "8.5",
        "0.0",
        "8.5"
      ],
      "formulas": [
        "NI1  = (A*10)/10    NI2  = (F*10)/10    MI = (NI1*5 + NI2*5) / 10MF = (MI + PF) / 2"
      ],
      "tia": "31338526"
    },
    {
      "nome": "SISTEMAS DE GESTAO COMERCIAL",
      "notas": [
        "10.0",
        "",
        "",
        "",
        "",
        "6.8",
        "10.0",
        "",
        "",
        "",
        "",
        "0.5",
        "9.5",
        "0.0",
        "9.5"
      ],
      "formulas": [
        "NI1  = (A*5)/5    NI2  = (F*3 + G*2)/5    MI = (NI1*5 + NI2*5) / 10 + PARTICMF = (MI + PF) / 2"
      ],
      "tia": "31338526"
    },
    {
      "nome": "SISTEMAS GESTAO CAPITAL HUMANO",
      "notas": [
        "6.5",
        "7.6",
        "",
        "",
        "",
        "8.8",
        "5.0",
        "",
        "",
        "",
        "",
        "0.9",
        "7.6",
        "",
        "7.6"
      ],
      "formulas": [
        "NI1  = (A*3 + B*2)/5    NI2  = (F*2 + G*3)/5    MI = (NI1*5 + NI2*5) / 10 + PARTICMF = (MI + PF) / 2"
      ],
      "tia": "31338526"
    },
    {
      "nome": "TRABALHO CONCLUSAO DE CURSO II",
      "notas": [
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "AprovadoBOM"
      ],
      "formulas": [
        "PF"
      ],
      "tia": "31338526"
    }
  ],
  [
    {
      "nome": "AUDITORIA SISTEM DE INFORMACAO",
      "notas": [
        "9.4",
        "",
        "",
        "",
        "",
        "8.3",
        "",
        "",
        "",
        "",
        "",
        "",
        "8.8",
        "",
        "8.8"
      ],
      "formulas": [
        "NI1  = (A*5)/5    NI2  = (F*5)/5    MI = (NI1*5 + NI2*5) / 10 + PARTICMF = (MI + PF) / 2"
      ],
      "tia": "31348408"
    },
    {
      "nome": "ESTAGIO SUPERVISIONADO",
      "notas": [
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "Aprovado"
      ],
      "formulas": [
        "PF"
      ],
      "tia": "31348408"
    },
    {
      "nome": "GOVERNANCA DE TI",
      "notas": [
        "9.0",
        "",
        "",
        "",
        "",
        "9.0",
        "",
        "",
        "",
        "",
        "",
        "",
        "9.0",
        "0.0",
        "9.0"
      ],
      "formulas": [
        "NI1  = (A*10)/10    NI2  = (F*10)/10    MI = (NI1*5 + NI2*5) / 10MF = (MI + PF) / 2"
      ],
      "tia": "31348408"
    },
    {
      "nome": "SISTEMAS DE GESTAO COMERCIAL",
      "notas": [
        "7.8",
        "",
        "",
        "",
        "",
        "6.8",
        "9.2",
        "",
        "",
        "",
        "",
        "0.4",
        "8.1",
        "0.0",
        "8.1"
      ],
      "formulas": [
        "NI1  = (A*5)/5    NI2  = (F*3 + G*2)/5    MI = (NI1*5 + NI2*5) / 10 + PARTICMF = (MI + PF) / 2"
      ],
      "tia": "31348408"
    },
    {
      "nome": "SISTEMAS GESTAO CAPITAL HUMANO",
      "notas": [
        "7.2",
        "7.2",
        "",
        "",
        "",
        "8.6",
        "7.6",
        "",
        "",
        "",
        "",
        "0.9",
        "8.5",
        "",
        "8.5"
      ],
      "formulas": [
        "NI1  = (A*3 + B*2)/5    NI2  = (F*2 + G*3)/5    MI = (NI1*5 + NI2*5) / 10 + PARTICMF = (MI + PF) / 2"
      ],
      "tia": "31348408"
    },
    {
      "nome": "TRABALHO CONCLUSAO DE CURSO II",
      "notas": [
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "AprovadoBOM"
      ],
      "formulas": [
        "PF"
      ],
      "tia": "31348408"
    }
  ]
]
```
</details>
      
# Requerimento mínimo:
- PHP 7.0 (Não foi confirmado se funciona no 5.6)
