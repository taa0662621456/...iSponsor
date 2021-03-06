<?php

	namespace App\Form\Vendor;

	use App\Entity\Vendor\VendorsDocumentAttachments;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class VendorsDocumentAttachmentsType
		extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder,
								  array $options)
		{
			$builder
				->add('uuid')
				->add('slug')
				->add('createdOn')
				->add('createdBy')
				->add('modifiedOn')
				->add('modifiedBy')
				->add('lockedOn')
				->add('lockedBy')
				->add('version')
				->add('fileName')
				->add('fileTitle')
				->add('fileDescription')
				->add('fileMeta')
				->add('fileClass')
				->add('fileMimeType')
				->add('fileLayoutPosition')
				->add('filePath')
				->add('filePathThumb')
				->add('fileIsDownloadable')
				->add('fileIsForSale')
				->add('fileParams')
				->add('fileLang')
				->add('fileShared')
				->add('published')
				->add('attachments')
			;
		}

		public function configureOptions(OptionsResolver $resolver)
		{
			$resolver->setDefaults(
				[
					'data_class'         => VendorsDocumentAttachments::class,
					'translation_domain' => 'vendor'
				]
			);
		}
	}
