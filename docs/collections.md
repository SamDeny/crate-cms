Crate Collections
=================

Collections are the central part of Crate, the dynamic structured content management itself. 
However, since Crate is designed to be higly modular with interchangeable components even the 
Collections system is just a single module you've to install to use it.


What are Collections?
---------------------

Collections are a two-faced component, the first one - the **Scheme** - declares the whole content 
structure which should be stored within the collection. WordPress developers may compare this with 
WordPress' **Post Type** system and while this is not directly wrong, it does not fully describe the 
capabilities of the scheme part. You can define everything with Schemes: the content (post types), 
independently overlapping groups (taxonomies) or even a simple configuration structures.

> A **Scheme** is the database table definition as in a relational database systems (like MySQL).

The second face are the **Documents** itself. A document is just a simple record as declared by the 
scheme (depending on the used scheme, as described below). Crate's Collection component already 
manage the default meta data per document, which consists of an unique UUID, a created; updated; 
deleted timestamps and the user relatinship based on the sent token. So, those data don't has to be
defined within the based **Scheme**.

> A **Document** is the simple record / row as stored in a database table.


### Schemes

**Schemes** are the main definition structure in Crate's Collection component. There are three 
different types of Scheme you can create:

; Strict Schemes...
: ... are the default structure, on which each single field is defined and known.
; Dynamic Schemes...
: ... are a more vague structure, which allows adding custom field-data on the fly.
; Virtual Schemes...
: ... are structures which does not belong to a single collection. Moreover it supports to be used 
with different multiple collections. However, the documents itself will still be stored in just one, 
depending on the configurations and conditions of the virtual scheme as well as the content and 
details of the document. For example: You can create different workspaces, revisions or just 
separate the documents depending on the user who pushed it.

Each Scheme is stored locally, within your Crate installation which allows your version control 
system to take track of them, as well as within Crate's own database table `crate_schemes`.
The database table does always contain the latest version of the Scheme, while your local 
environment should contain all versions (Migrations).


### Documents

**Documents** are the single records within a collection following the structure of the declared 
**Scheme**. Each document
