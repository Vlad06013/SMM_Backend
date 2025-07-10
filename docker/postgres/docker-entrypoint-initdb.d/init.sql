CREATE USER user_smm_duck_backend WITH PASSWORD 'lSj4jdfgi!p_3';
CREATE DATABASE db_smm_duck_backend;
GRANT ALL PRIVILEGES ON DATABASE db_smm_duck_backend TO user_smm_duck_backend;
ALTER DATABASE db_smm_duck_backend OWNER TO user_smm_duck_backend;

CREATE USER user_smm_duck_backend_test WITH PASSWORD 'lSj4jdfgi!p_3_test';
CREATE DATABASE db_smm_duck_backend_test;
GRANT ALL PRIVILEGES ON DATABASE db_smm_duck_backend_test TO user_smm_duck_backend_test;
ALTER DATABASE db_smm_duck_backend_test OWNER TO user_smm_duck_backend_test;
