import mysql

import pandas as pd,os,subprocess
# for directory, dirnames, filenames in os.walk(os.getcwd()):
#     # run here your code
#     print filenames

import mysql.connector as sql,subprocess
import pandas as pd

os.chdir('reference')
subprocess.call('./auxcommand.sh',shell=True)
os.chdir('..')
db_connection = sql.connect(host='127.0.0.1', database='grocerycrud', user='root', password='')
db_cursor = db_connection.cursor(buffered=True)
db_cursor.execute('SELECT * FROM grocerycrud.docker')

# from mysql.connector import MySQLConnection, Error
#
# MySQLConnection.connect()

#    docker ps --format '{{.Names}}\t{{.Image}}\t{{.Command}}\t{{.Status}}\t{{.Ports}}\t{{.ID}}\t{{.RunningFor}}' > docker_proccesses_${server}proclog

semtext='{{.ID}}\t{{.Names}}\t{{.Image}}\t{{.Command}}\t{{.Status}}\t{{.Ports}}\t{{.RunningFor}}'
commands=[x.replace('{{','').replace('}}','').replace('.','') for x in semtext.split('\t')]

db_cursor.execute("delete from docker")
db_connection.commit()

file_count = 0
for file in os.listdir(os.getcwd()+'/reference/'):
    if 'proclog' in file:
        # df = pd.DataFrame.from_csv(f, sep='\t')
        # df.to_sql()
        with open('reference/'+file, 'r') as reader:
            for line in reader:
                try:
                    elements=line.strip().split('\t')
                    hostname=file.replace('docker_proccesses_','').replace('.proclog','')

                    containerid = elements[commands.index("ID")]

                    cmd_dent = 'ssh -t %s "dent %s"'%(hostname,containerid)
                    cmd_logs = 'ssh -t %s "docker logs %s"'%(hostname,containerid)

                    elements.append(hostname)
                    elements.append(hostname +'_'+elements[0])

                    elements.append(cmd_dent)
                    elements.append(cmd_logs)

                    sqlcmd='insert into docker(containerid, name, image, command, status, ports,created,host,recordkey,cmd_dent,cmd_logs) values (\'%s\')'%("', '".join(elements))
                    print sqlcmd
                    db_cursor.execute(sqlcmd.decode('UTF-8'))
                    db_connection.commit()
                    # db_cursor.
                    file_count+=1

                except Exception as e:
                    print e


print 'process count: %s'%file_count