--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: msg; Type: TABLE; Schema: public; Owner: student; Tablespace: 
--

CREATE TABLE msg (
    username character varying(255),
    message character varying(255),
    "time" character varying(255)
);


ALTER TABLE public.msg OWNER TO student;

--
-- Name: user; Type: TABLE; Schema: public; Owner: student; Tablespace: 
--

CREATE TABLE "user" (
    username character varying(255),
    password character varying(255)
);


ALTER TABLE public."user" OWNER TO student;

--
-- PostgreSQL database dump complete
--

