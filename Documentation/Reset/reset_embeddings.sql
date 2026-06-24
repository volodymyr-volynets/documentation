BEGIN;
DELETE FROM public.dn_embeddings WHERE dn_embedding_ai_ragtype_code = 'DN::PAGES';
DELETE FROM public.dn_embeddings WHERE dn_embedding_ai_ragtype_code = 'DN::FRAGMENTS';
DELETE FROM public.tm_batch_records WHERE tm_batchrecord_tm_batchtype_code = 'DN_EMBEDDINGS';
DELETE FROM public.tm_batch_entries WHERE tm_batchentry_tm_batchtype_code = 'DN_EMBEDDINGS';
COMMIT;