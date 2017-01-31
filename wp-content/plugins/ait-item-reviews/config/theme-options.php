<?php

return array(
	'raw' => array(
		'itemReviews' => array(
			'title' => __('Item Reviews', 'ait-item-reviews'),
			'options' => array(
				'notifications' => array(
					'label'		=> __('Email notifications', 'ait-item-reviews'),
					'type'		=> 'on-off',
					'default'	=> true,
				),
				'question1' => array(
					'label' 	=> __('Question 1', 'ait-item-reviews'),
					'type'		=> 'text',
					'default'	=> 'Price',
				),
				'question2' => array(
					'label' 	=> __('Question 2', 'ait-item-reviews'),
					'type'		=> 'text',
					'default'	=> 'Location',
				),
				'question3' => array(
					'label' 	=> __('Question 3', 'ait-item-reviews'),
					'type'		=> 'text',
					'default'	=> 'Staff',
				),
				'question4' => array(
					'label' 	=> __('Question 4', 'ait-item-reviews'),
					'type'		=> 'text',
					'default'	=> 'Services',
				),
				'question5' => array(
					'label' 	=> __('Question 5', 'ait-item-reviews'),
					'type'		=> 'text',
					'default'	=> 'Food',
				),
				
				'onlyRegistered' => array(
					'label' 	=> __('Only registered users can add review', 'ait-item-reviews'),
					'type'		=> 'on-off',
					'default'	=> false,
				),

				'onlyRegisteredMessage' => array(
					'label' 	=> __('Message to display for non registered users', 'ait-item-reviews'),
					'type'		=> 'text',
					'default'	=> __('Only registered users can add a review', 'ait-item-reviews'),
				),

			),
		),
	),
	'defaults' => array(
		'itemReviews' => array(
			'notifications'	=> true,
			'question1' => 'Price',
			'question2' => 'Location',
			'question3' => 'Staff',
			'question4' => 'Services',
			'question5' => 'Food',
			'onlyRegistered' => false,
			'onlyRegisteredMessage' => __('Only registered users can add a review', 'ait-item-reviews'),
		)
	)
);